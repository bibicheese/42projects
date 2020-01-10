/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   init_aux.c                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/19 11:10:34 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 15:00:11 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static int		equal_sign(char *str)
{
	int		i;

	i = 0;
	while (str[i])
	{
		if (str[i] == '=')
			return (i);
		i++;
	}
	return (0);
}

char			**lenv(char **env)
{
	char	**left_side;
	char	**both;
	int		i;

	i = 0;
	if (!env)
		return (NULL);
	if (!(left_side = (char **)malloc(sizeof(char *) * (ft_arrlen(env) + 1))))
		return (NULL);
	i = -1;
	while (env[++i])
	{
		both = ft_strsplit(env[i], "=");
		left_side[i] = ft_strdup(both[0]);
		free_tab(both);
	}
	left_side[i] = NULL;
	return (left_side);
}

char			**renv(char **env)
{
	char	**right_side;
	char	**both;
	int		i;

	i = 0;
	if (!env)
		return (NULL);
	if (!(right_side = (char **)malloc(sizeof(char *) * (ft_arrlen(env) + 1))))
		return (NULL);
	i = -1;
	while (env[++i])
	{
		both = ft_strsplit(env[i], "=");
		right_side[i] = both[1] ? ft_strdup(both[1])
			: ft_strdup(env[i] + equal_sign(env[i]));
		free_tab(both);
	}
	right_side[i] = NULL;
	return (right_side);
}
