/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   launch.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/10 13:12:55 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/12 18:40:54 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

void	launch(char **args, t_shell *shell)
{
	pid_t	pid;
	char	*cmd;
	
	pid = fork();
	cmd = find_cmd(shell, args[0]);
	if (pid == 0) 
	{
		if (execve(cmd, args, shell->env) == -1)
		{
			if (execve(args[0], args, shell->env) == -1)
			{
				ft_putstr_fd("minishell: command not found: ", 2);
				ft_putstr_fd(args[0], 2);
				write(1, "\n", 1);
				shell->error = 1;
			}
		}
	}
	else if (pid < 0) 
		ft_putstr_fd("minishell: process not created\n", 2);
	else 
		waitpid(pid, NULL, 0);
}

void	prompt(t_shell *shell)
{
	char 	cwd[1024];
	int		i;

	getcwd(cwd, 1024);
	i = ft_strlen(cwd);
	while (cwd[i] != '/')
		i--;
	i++;
	shell->error > 0 ? write(1, "\033[1;31m", 7) : write(1, "\033[1;32m", 7);
	write(1, "-->  ", 5);
	write(1, "\033[1;36m", 7);
	write(1, cwd + i, ft_strlen(cwd) - i);
	write(1, "\033[1;33m", 7);
	write(1, " % ", 3);
	write(1, "\033[0m", 5);
	shell->error = 0;
}

char	**array_cpy(char **src)
{
	char	**dst;
	int		i;
	int		j;

	i = 0;
	j = 0;
	while (src[i])
		i++;
	if (!(dst = malloc(sizeof(char *) * i + 1)))
		return (NULL);
	i = 0;
	while (src[i])
	{
		dst[i] = ft_strdup(src[i]);
		i++;
	}
	dst[i] = NULL;
	return (dst);
}
