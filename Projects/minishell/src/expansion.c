/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   expansion.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/19 09:56:14 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 15:05:16 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static char		*dollar_conv(char *arg, t_shell *shell)
{
	int		i;
	int		j;

	i = 0;
	j = 0;
	if (shell->lenv)
	{
		while (shell->lenv[i])
		{
			if (!ft_strcmp(shell->lenv[i], (arg + 1)))
				return (ft_strdup(shell->renv[i]));
			i++;
		}
	}
	return (ft_strdup(arg));
}

static char		*tild_conv(char *arg, t_shell *shell)
{
	int		i;
	char	*tmp;

	i = -1;
	tmp = NULL;
	if (arg[1])
		tmp = arg + 1;
	if (shell->env)
	{
		while (shell->env[++i])
		{
			if (!ft_strcmp(shell->lenv[i], "HOME"))
				return (tmp ? ft_strjoin(shell->renv[i], tmp)
						: ft_strdup(shell->renv[i]));
		}
	}
	return (ft_strdup(arg));
}

char			**expansion(char **args, t_shell *shell)
{
	int		i;
	char	**newargs;

	i = 0;
	while (args[i])
		i++;
	if (!(newargs = (char **)malloc(sizeof(char *) * (i + 1))))
		return (NULL);
	i = -1;
	while (args[++i])
	{
		if (args[i][0] == '$')
			newargs[i] = dollar_conv(args[i], shell);
		else if (args[i][0] == '~')
			newargs[i] = tild_conv(args[i], shell);
		else
			newargs[i] = ft_strdup(args[i]);
	}
	newargs[i] = NULL;
	free_tab(args);
	return (newargs);
}
