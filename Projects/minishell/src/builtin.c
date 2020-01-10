/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   builtin.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/12 18:54:25 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 15:10:05 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static void		echo(char **args)
{
	int		i;

	i = 1;
	while (args[i])
	{
		if (args[i][0] == '$')
			i++;
		else
		{
			ft_putstr(args[i]);
			ft_putchar(' ');
			i++;
		}
	}
	ft_putchar('\n');
}

static void		env(t_shell *shell)
{
	int		i;

	i = 0;
	if (shell->env)
	{
		while (shell->env[i])
		{
			ft_putstr(shell->env[i]);
			ft_putstr("\n");
			i++;
		}
	}
}

static void		ft_exit(char **args, t_shell *shell)
{
	if (args[1] && args[2])
	{
		ft_putstr_fd("exit: too many arguments\n", 2);
		shell->error = 1;
		return ;
	}
	else
	{
		ft_memdel((void **)&shell->oldpwd);
		free_tab(shell->env);
		free_tab(shell->paths);
		free_tab(shell->lenv);
		free_tab(shell->renv);
		args[1] ? exit(ft_atoi(args[1])) : exit(0);
	}
}

int				builtin(char **args, t_shell *shell)
{
	if (!ft_strcmp(args[0], "exit"))
		ft_exit(args, shell);
	else if (!ft_strcmp(args[0], "cd"))
		ft_cd(args, shell);
	else if (!ft_strcmp(args[0], "echo"))
		echo(args);
	else if (!ft_strcmp(args[0], "env"))
		env(shell);
	else if (!ft_strcmp(args[0], "setenv"))
		ft_setenv(shell, args);
	else if (!ft_strcmp(args[0], "unsetenv"))
		ft_unsetenv(args, shell);
	else
		return (0);
	return (1);
}
